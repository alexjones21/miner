<?php
set_time_limit(0);

$curPath = realpath(__DIR__.'/..');
$cpuMinerPath = $curPath.'/cpuminer';
$stratumPath = $curPath.'/stratum-mining-proxy';

echo PHP_EOL."Installing Dependencies...";
shell_exec('apt-get install -y libcurl4-openssl-dev');
shell_exec('apt-get install -y python-dev');
shell_exec('apt-get install -y make');
shell_exec('apt-get install -y automake');
shell_exec('apt-get install -y g++');

echo PHP_EOL."Installing CPU Miner...";
shell_exec('git clone https://github.com/pooler/cpuminer '.$cpuMinerPath);
shell_exec('cd '.$cpuMinerPath.'; ./autogen.sh; ./configure CFLAGS="-O3"; make;');

echo PHP_EOL."Installing Stratum Mining Proxy...";
shell_exec('git clone https://github.com/bandroidx/stratum-mining-proxy '.$stratumPath);
shell_exec('cd '.$stratumPath.'; python distribute_setup.py; cd litecoin_scrypt; python setup.py install; cd ..; python setup.py develop; chmod +x mining_proxy.py');

echo PHP_EOL."Done!".PHP_EOL;
