#!/bin/bash

# Get configuration
. config

echo [i] Create Namespaces if necessary
[ $(kubectl get ns $NS1 2> /dev/null | wc -l) -eq 0 ] && kubectl create ns $NS1
[ $(kubectl get ns $NS2 2> /dev/null | wc -l) -eq 0 ] && kubectl create ns $NS2

echo [i] Create ssh keys ... if necessary
[ ! -d ./key ] && mkdir -p ./key
[ ! -f ./key/ssh ] && ssh-keygen -f ./key/ssh -t ed25519 -P "" -C "user@ssh"

echo [i] Deploy entry challange
helm install entry ./charts/entry                  \
        --set namespace=$NS1                           \
        --set egg.secret=$EGG1                     \
        --set egg.config=$EGG4                 \
        --set-file ssh.private_key=./key/ssh       \
        --set-file ssh.public_key=./key/ssh.pub    \
        --set network.pod=$POD_SUBNET              \
        --set network.svc=$SVC_SUBNET

echo [i] Deploy SSH Challange
helm install ssh ./charts/ssh                      \
        --set namespace=$NS1                           \
        --set egg.env=$EGG5                    \
        --set-file ssh.public_key=./key/ssh.pub     \
        --set network.pod=$POD_SUBNET              \
        --set network.svc=$SVC_SUBNET

echo [i] Deploy egg challanges
helm install egg ./charts/egg                  \
        --set namespace=$NS1                           \
        --set egg.env=$EGG6                      

echo [i] Deploy joker challanges
helm install joker ./charts/joker                  \
        --set namespace=$NS1                           \
        --set dnsZone=$DNS_ZONE                    \
        --set egg.env=$EGG7                      

echo [i] Deploy namespace challange
helm install honk ./charts/honk                    \
        --set namespace=$NS2                           \
        --set egg.env=$EGG8

echo [i] Label Namespace default and kube-system
kubectl label namespace default ns=default
kubectl label namespace kube-system ns=kube-system


# Only for AWS

if [ $IAAS = "AWS" ]
then

  echo [i] Deploy loadbalancer traefik
  [ $(kubectl get ns traefik 2> /dev/null | wc -l) -eq 0 ] && kubectl create ns traefik
  helm install traefik stable/traefik               \
          --namespace traefik                       \
          --set dashboard.enabled=false             \
          --set accessLogs.enabled=true             \
          --set rbac.enabled=true                   \
          --set serviceType=LoadBalancer
  
  echo [i] Install Calico for NetworkPolicies
  kubectl apply -f https://raw.githubusercontent.com/aws/amazon-vpc-cni-k8s/release-1.5/config/v1.5/calico.yaml
  
  echo [i] Install datadog
  helm install datadog stable/datadog               \
  	--set datadog.site=datadoghq.eu           \
          --set token=whateverwhateverwhateverwhateverwhateverwhateverwhateverwhateverwhatever\
          --set datadog.apiKey=$DATADOG_API_KEY
  kubectl apply -f datadog-metric-np.yaml

fi # end AWS
	

echo [i] Done!

exit 0
