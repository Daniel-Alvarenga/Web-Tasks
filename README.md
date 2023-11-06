# Web-Tasks
A web system made in PHP to controll your tasks using a local database

## Overview
This repository contains a simple PHP project for managing your tasks through a web interface. It allows you to create, edit, and delete tasks, as well as mark them as completed. The system uses a local MySQL database for data storage. To get started, follow the steps below:

1. Prerequisites:
   - Install XAMPP or any other local server environment.
   - Create a database connection and a MySQL database.
   
2. Clone the Repository:

git clone https://github.com/Daniel-Alvarenga/Web-Tasks.git

sql


3. Import Database:
- Execute the SQL script from the `database` folder in your MySQL database to create the necessary tables.

4. Access the Web Application:
- Start your local server.
- Open your web browser and navigate to the URL of your database connection, e.g., `http://localhost/web-tasks`.

## Database
The project uses a MySQL database named `tarefas` with a table called `tarefas`. The table schema is as follows:

```sql
CREATE DATABASE tarefas;
USE tarefas;

CREATE TABLE tarefas (
 id INT AUTO_INCREMENT PRIMARY KEY,
 titulo VARCHAR(255) NOT NULL,
 descricao TEXT NOT NULL,
 data_vencimento DATE NOT NULL,
 data_conclusao DATE
);
```
## PHP Scripts

The core of the project is implemented in the index.php file. Here are the main functionalities:

   - exibirTarefas: Function to display tasks from the database.
   - criarTarefa: Function to create a new task.
   - editarTarefa: Function to edit an existing task.
   - excluirTarefa: Function to delete a task.
   - Task CRUD operations based on user actions and form submissions.

## Styling

The styling of the web application is done using CSS. You can find the styles in the index.php file. It provides a simple and user-friendly interface for managing tasks.

## Configuration

To configure the database connection, update the config.php file with your database credentials.

```php

$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'tarefas';
```

## Project Features

   - Create, edit, and delete tasks.
   - Mark tasks as completed.
   - User-friendly interface.
   - Local MySQL database for data storage.

Enjoy using the Web-Tasks application to efficiently manage your daily tasks!
