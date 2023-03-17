#!/bin/bash
sudo apt-get -y  update

sudo apt -y install apache2


sudo apt -y install php libapache2-mod-php php-mysql


sudo apt -y install mysql-server


sudo apt -y install ffmpeg


sudo apt -y install python3-opencv


sudo chown ubuntu:ubuntu /var/www

( cd ~/.ssh ; ssh-keygen -o -t rsa -C "cosmojack@gmail.com")

cat ~/.ssh/id_rsa.pub

(cd /var/www ; git clone git@github.com:Cosmo-J/Anamorphiser.git)

sudo chown ubuntu:www-data /var/www/Anamorphiser/outputs
sudo chown ubuntu:www-data /var/www/Anamorphiser/uploads
sudo chown ubuntu:www-data /var/www/Anamorphiser/workspace
sudo chown ubuntu:www-data /var/www/Anamorphiser/workspace/anamorph_movie
sudo chown ubuntu:www-data /var/www/Anamorphiser/workspace/in_frames
sudo chown ubuntu:www-data /var/www/Anamorphiser/workspace/out_frames

alias wagwan='cat /var/log/apache2/error.log'
alias wagref='truncate -s 0 /var/log/apache2/error.log'
source ~/.bashrc

 


echo "change apache2 home dir in /etc/apache2/sites-available/000-default.conf"
echo "sudo nano /etc/apache2/sites-available/000-default.conf"
echo "then run"
echo "sudo service apache2 restart"
echo "change post size in"
echo "/etc/php/8.1/apache2/php.ini"
