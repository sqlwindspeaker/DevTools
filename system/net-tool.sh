
SYS=`uname -s`
# Darwin for mac
# Linux for linux

echo -e "netstat:"
echo -e "\t查看当前打开的所有tcp(udp)连接"
echo -e "\tnetstat -antpe(netstat -anupe)"
echo -e "\t查看当前打开已建立连接的tcp连接"
echo -e "\tnetstat -ntpe"
echo -e "\t查看当前打开处于监听状态的tcp连接"
echo -e "\tnetstat -lntpe"

echo -e "lsof:"
echo -e "\t查看所有网络连接"
echo -e "\tlsof"
echo -e "\t查看所有tcp(udp)网络连接"
echo -e "\tlsof tcp(udp)"
echo -e "\t查看谁在使用3306端口"
echo -e "\tlsof -i :3306"
echo -e "\t查看用户sqlbob打开的文件"
echo -e "\tlsof -u sqlbob"
echo -e "\t查看某个文件的使用情况"
echo -e "\tlsof /path/to/file"
echo -e "\t查看pid为1111, 3333, 1234的3个进程打开的文件"
echo -e "\tlsof -p 1111,3333,1234"
echo -e "\t查看pid为lsof -p 1111,3333,1234"
echo -e "\t查看程序名字以mysql开头的程序打开的文件"
echo -e "\tlsof -c mysql"
echo -e "使用-a参数可以AND组合上面的功能，比如:"
echo -e "\t查看pid为1234的进程打开的网络接口"
echo -e "\tlsof -a -p 1234 -i"
echo -e "\t查看用户名为sqlbob的用户打开的网络接口"
echo -e "\tlsof -a -u sqlbob -i"
echo -e "使用^来获得exclusive的功能，比如:"
echo -e "\t查看除pid为1234以外的进程打开的文件"
echo -e "\tlsof -p ^1234"
echo -e "\t查看除了sqlbob以外的用户打开的文件"
echo -e "\tlsof -u ^sqlbob"
echo -e "\t查看不是mysql开头的程序打开的文件"
echo -e "\tlsof -c ^mysql"

