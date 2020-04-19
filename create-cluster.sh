#!/bin/bash

NAME="easter-ctf"
REGION="eu-central-1"
NODE_GROUP_NAME="easter-ctf-nodes"
NODE_SIZE="t2.medium"
SSH_KEY=""
AWS_PROFILE=


eksctl create cluster \
--name $NAME \
--region $REGION \
--nodegroup-name $NODE_GROUP_NAME \
--node-type $NODE_SIZE \
--nodes 2 \
--nodes-min 1 \
--nodes-max 4 \
--ssh-access \
--ssh-public-key $SSH_KEY \
--managed

exit 0
