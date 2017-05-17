## Yêu cầu cài đặt:

- Git
- Docker
- Docker-compose
- Bower

## Hướng dẫn cài đặt:
- Đầu tiên
```bash
git clone git@github.com:huespring94/quanli_taisan.git
```
hoặc
```bash 
git clone https://github.com/huespring94/quanli_taisan.git
 ```

- Tạo file .env và copy nội dung file .env.example vào 

- Vào thư mục laradock,
    `sudo docker-compose build`
    `sudo docker-compose up -d mysql nginx`
    `sudo docker exec -it laradock_workspace_1 bash`
    `composer install`
    `php artisan key:generate`

- Tạo datbaase tên quanli_db

- Gõ `php artisan migrate`
