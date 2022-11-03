curl -d "name=jane&age=gr" -H "Content-Type: application/x-www-form-urlencoded" -X POST http://127.0.0.1:3000/index04.php
curl -d "age=-20" -H "Content-Type: application/x-www-form-urlencoded" -X POST http://127.0.0.1:3000/index04.php
curl -d "age=2" -H "Content-Type: application/x-www-form-urlencoded" -X POST http://127.0.0.1:3000/index04.php
curl -d "name=jane&age=2" -H "Content-Type: application/x-www-form-urlencoded" -X POST http://127.0.0.1:3000/index04.php
curl -d "name=fs&age=" -H "Content-Type: application/x-www-form-urlencoded" -X POST http://127.0.0.1:3000/index04.php