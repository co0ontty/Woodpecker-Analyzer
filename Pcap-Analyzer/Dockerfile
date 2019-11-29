FROM 127.0.0.1:5000/co0ontty/ubuntu:16.04
EXPOSE 8000

VOLUME /home/dj/PCAP /var/log/gunicorn /home/dj/Files/PDF \
       /home/dj/Files/All /home/dj/Files/FTP /home/dj/Files/Mail /home/dj/Files/Web

RUN apt-get update && apt-get install python3-pip tcpdump graphviz imagemagick -y &&\
    pip3 install --no-cache-dir -i https://pypi.doubanio.com/simple/ scapy Flask Flask-WTF geoip2 pyx requests gunicorn

COPY ./ /

CMD gunicorn -c deploy_config.py run:app
