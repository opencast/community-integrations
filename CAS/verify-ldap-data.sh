#!/bin/bash

echo "#############"
echo "Testing admin"
echo "#############"
docker exec -it cas-ldap_server-1 ldapsearch -x -b 'dc=example,dc=org' -D "cn=admin,dc=example,dc=org" -w admin '(objectclass=*)'
