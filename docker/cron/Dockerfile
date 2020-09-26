FROM centos

ADD cron.d /etc/cron.d/
RUN chmod 0644 /etc/cron.d/*

CMD crond && tail -f /dev/null

