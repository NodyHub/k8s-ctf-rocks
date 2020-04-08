FROM alpine:3.11

RUN apk add openssh nmap curl 

RUN adduser --disabled-password user

RUN echo "HISTFILE=/dev/null" > /etc/profile.d/history_off

# Prepare keys and cfg
COPY sshd_config /home/user/.ssh/sshd_config
RUN chmod 655 /home/user/.ssh/sshd_config && \
    chown -R user:user /home/user

USER user
WORKDIR /home/user

CMD /usr/bin/ssh-keygen -b 2048 -t rsa -P "" -q -f /home/user/.ssh/key/host_key ;  \
    /usr/sbin/sshd -D -f /home/user/.ssh/sshd_config 

EXPOSE 6667
