CREATE DATABASE tarefas;
USE tarefas;

CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    data_vencimento DATE NOT NULL,
    data_conclusao DATE
);