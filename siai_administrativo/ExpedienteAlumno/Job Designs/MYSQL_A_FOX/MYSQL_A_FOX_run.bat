%~d0
 cd %~dp0
java -Xms256M -Xmx1024M -cp classpath.jar; etl_upes_mysql_a_fox.mysql_a_fox_0_1.MYSQL_A_FOX --context=Default %* 