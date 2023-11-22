<?php
require 'init.php';

//delete
query(
    'delete from category'
);
//change add 1
query(
    'alter table category auto_increment=1'
);

$cat = ['hat','shirt','cake','drink','coffee','life'];
foreach($cat as $c){
query(
    'insert into category (slug,name) values (?, ?)',
    [slug($c),$c]
);
}
echo 'successfully';
