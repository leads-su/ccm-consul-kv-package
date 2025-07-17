FROM docker.leads.su/ccm/application-image:8.1

ARG USER_ID
ARG GROUP_ID

RUN groupadd -g $GROUP_ID app && \
    useradd -g app -u $USER_ID -s /bin/bash -m app
COPY id_rsa /home/app/.ssh/id_rsa
RUN chown -R app:app /home/app/.ssh && chmod 700 /home/app/.ssh && chmod 600 /home/app/.ssh/id_rsa
#RUN ssh-keyscan -H gitlab.leads.local >> /home/app/.ssh/known_hosts
RUN su app -c "ssh-keyscan -H gitlab.leads.local >> /home/app/.ssh/known_hosts"

USER app
