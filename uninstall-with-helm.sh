#!/bin/bash

# Get configuration
. config

echo [i] Remove entry challange
helm uninstall entry --namespace $NS1

echo [i] Remove SSH Challange
helm uninstall ssh --namespace $NS1

echo [i] Remove egg challanges
helm uninstall egg --namespace $NS1

echo [i] Remove joker challanges
helm uninstall joker --namespace $NS1

echo [i] Remove namespace challange
helm uninstall honk --namespace $NS2

echo [i] Remove Datadog 
helm uninstall datadog

echo [i] Remove Calico
kubectl delete -f https://raw.githubusercontent.com/aws/amazon-vpc-cni-k8s/release-1.5/config/v1.5/calico.yaml

echo [i] Done!

exit 0
