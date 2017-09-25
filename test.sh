#!/bin/bash
cd `dirname $0`
./app/service user stop 

./app/service user 
./src/Service/User/client.php 
