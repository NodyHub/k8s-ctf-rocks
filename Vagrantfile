
################################################################################################
#  Dont forget to define EGGS in config !!!!!
################################################################################################

Vagrant.configure("2") do |config|
  # define system 
  config.vm.box = "bento/ubuntu-18.04"

  # Copy repo
  config.vm.provision "file", 
    source: ".", 
	destination: "/home/vagrant/"

  # install k3s
  config.vm.provision "shell", 
    privileged: false,
    inline: <<-SHELL
      . ./config
      curl -sfL https://get.k3s.io | INSTALL_K3S_EXEC="--cluster-cidr=$POD_SUBNET --service-cidr=$SVC_SUBNET --write-kubeconfig-mode=644 --no-flannel" sudo -E sh -
      mkdir -p ~/.kube
      ln -s /etc/rancher/k3s/k3s.yaml ~/.kube/config
      sleep 3
      kubectl apply -f calico.yaml
    SHELL
  
  # install helm
  config.vm.provision "shell", 
    privileged: false,
    inline: <<-SHELL
      curl -fsSL -o ~/get_helm.sh https://raw.githubusercontent.com/helm/helm/master/scripts/get-helm-3
      chmod 700 ~/get_helm.sh
      ~/get_helm.sh
      rm ~/get_helm.sh
    SHELL
  

  # deploy challenges
  config.vm.provision "shell", 
    privileged: false,
    inline: <<-SHELL
      chmod +x ./install-with-helm.sh
      ./install-with-helm.sh
    SHELL

  # Make challenges accessible
  config.vm.network "forwarded_port", 
    guest: 80, 
    host: 8080

end

