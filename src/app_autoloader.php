<?php

$classMap = [
    "PostbackAPI/RestfulAPI",
    "PostbackAPI/APIResponse",
    "PostbackAPI/config/ApiConfig",
    "PostbackAPI/controller/BaseController",
    "PostbackAPI/controller/PostbackController",
    "PostbackAPI/dbaccess/APIContext",
    "PostbackAPI/dbaccess/DBConnection"
];

spl_autoload_register(function ($class){
    // Namespace prefix
    $prefix = 'PostbackAPI\\';

    // Base directory tương ứng cho namespace prefix, thư mục src
    $base_dir = __DIR__ . '/';
    
    // Tên Class đầy đủ có chứa Namespace prefix không?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // Không => Không thuộc chuẩn PSR-4 => autoloader này sẽ bị bỏ qua
        return;
    }

    // Lấy phần còn của class name trừ namespace prefix
    $relative_class = substr($class, $len);

    /*
      Tìm đường dẫn đến file class:
      - Thay thế namespace prefix bằng tên base directory
      - Thay thế ký tự namespace separators \ bằng directory separator / (Linux)
      - Thêm ext .php
    */
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    echo $file;
    // Nếu file tồn tại thì require it
    if (file_exists($file)) {
        require $file;
    }
});