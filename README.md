# NewsPortal-Docker

A simple PHP & MySQL news management system containerized with Docker.  
The project allows users to register, log in, manage news articles, and organize them into categories.  
It is designed to be easy to run, reproducible, and suitable for academic and learning purposes.

---

## Tech Stack

- PHP 8.2 (Apache)
- MySQL 8.0
- Docker & Docker Compose
- HTML / CSS (basic UI)
- Git & GitHub

---
How to Build and Run Using Docker

### Prerequisites
Make sure the following tools are installed on your machine:
- Docker
- Docker Compose

### Build and Run the Project
From the project root directory, run the following command:
bash

docker compose up --build 

### This command will:

Build the PHP Docker image

Start the MySQL database container

Initialize the database schema automatically

Run the web application

Access the Application
After the containers are running, open your browser and visit:
http://localhost:8080

### Configuration Notes
Application Port

The web application runs on port 8080

Database Configuration (defined in docker-compose.yml)

Database name: news_db

Database user: news_user

Database password: news_pass

MySQL root password: root

No additional environment configuration is required.

## How to Test the Application
Open the application in the browser:http://localhost:8080
Register a new user using the registration page.

Log in with the created account.

Access the dashboard.

Add categories and news articles.

Refresh the page to confirm data persistence.

If all pages load correctly and data is stored in the database, the application is working as expected

## Attribution

This project was developed for educational purposes as part of an Operating Systems Lab assignment.
No external open-source project was directly reused.

## Docker Compose

This project uses Docker Compose to run multiple services:
- Web service (PHP + Apache)
- Database service (MySQL)

To start all services:
docker compose up --build

### Makefile Commands

To simplify working with Docker, a Makefile is provided:

- `make build` – Build Docker images
- `make run` – Run the application
- `make run-build` – Build and run the application
- `make stop` – Stop running containers
- `make clean` – Stop containers and remove volumes
- `make logs` – View container logs

> This project follows a professional Git workflow using feature branches and pull requests.


