#!/bin/bash

/usr/bin/mysqld_safe > /dev/null 2>&1 &

RET=1
while [[ RET -ne 0 ]]; do
    echo "=> Waiting for confirmation of MySQL service startup"
    sleep 5
    mysql -uroot -e "status" > /dev/null 2>&1
    RET=$?
done

#PASS=${MYSQL_PASS:-$(pwgen -s 12 1)}
#_word=$( [ ${MYSQL_PASS} ] && echo "preset" || echo "random" )
echo "=> Creating MySQL admin user with ${_word} password"


ADMIN="admin"
USER="lampschool"
PASS="lampschool"
DB="lampschool"
ROOTPASS="password"
mysqladmin -u root password $ROOTPASS 
mysql -uroot -p$ROOTPASS  -e "CREATE USER '$ADMIN'@'%' IDENTIFIED BY '$ROOTPASS'"
mysql -uroot -p$ROOTPASS -e "GRANT ALL PRIVILEGES ON *.* TO '$ADMIN'@'%' WITH GRANT OPTION"
mysql -uroot -p$ROOTPASS -e "CREATE USER '$USER'@'%' IDENTIFIED BY '$PASS'"
mysql -uroot -p$ROOTPASS -e "CREATE DATABASE $DB"
mysql -uroot -p$ROOTPASS -e "GRANT ALL PRIVILEGES ON $DB.* TO '$USER'@'%' WITH GRANT OPTION"


# You can create a /mysql-setup.sh file to intialized the DB
if [ -f /mysql-setup.sh ] ; then
  . /mysql-setup.sh
fi

echo "=> Done!"

echo "========================================================================"
echo "You can now connect to this MySQL Server using:"
echo ""
echo "    mysql -uadmin -p$PASS -h<host> -P<port>"
echo ""
echo "Please remember to change the above password as soon as possible!"
echo "MySQL user 'root' has no password but only allows local connections"
echo "========================================================================"

mysqladmin -uroot shutdown
