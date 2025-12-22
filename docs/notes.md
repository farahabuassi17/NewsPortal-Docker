# Technical Notes
## Biggest Docker Problem and Solution
The biggest issue I faced while working with Docker was related to the MySQL database initialization.
Although the database container was running, the required tables did not exist, which caused runtime errors in the PHP application.
I learned that MySQL Docker images execute initialization SQL files only on the first run.
Because a Docker volume already existed, the initialization script was not re-executed.
I solved this problem by removing the existing volume using `docker compose down -v`, fixing the database schema (adding AUTO_INCREMENT and correct column names), and rebuilding the containers.
This ensured that the database was created correctly and worked consistently for any developer running the project.

## Most Important Git/GitHub Lesson
The most important lesson I learned about Git and GitHub is the importance of a clean and professional workflow.
I learned how to initialize a repository, create meaningful commits, connect a local project to a remote GitHub repository, and push changes correctly using upstream branches.
Using clear commit messages helped me track my progress and made the project easier to understand for others.
This assignment taught me how GitHub is used in real-world projects to collaborate, document progress, and publish professional work.
.. 
### Docker Compose to manage multiple services
I used Docker Compose to manage multiple services (web and database),
making the project easier to run with a single command.

## GitHub Actions workflow 
I added a GitHub Actions workflow to automatically build the Docker image on every push, ensuring continuous integration and early detection of build issues.

### Multi-stage Docker Build

I used a multi-stage Docker build to reduce the final image size.
The first stage installs and prepares the required PHP extensions.
The second stage copies only the necessary runtime files and extensions.
This approach improves performance, reduces image size, and follows Docker best practices.

### Healthcheck

I added a Docker healthcheck to ensure the application is running correctly.
A simple health endpoint (health.php) was created to return HTTP 200.
Docker periodically checks this endpoint and marks the container as healthy or unhealthy.
This improves reliability and follows best practices for containerized applications.

### Makefile

I added a Makefile to simplify Docker commands.
Common tasks such as building, running, stopping, and cleaning the project
can now be executed using short and clear commands.
This makes the project easier to use for any developer.

### Pull Request Workflow

I used a feature branch and opened a Pull Request into the main branch.
The Pull Request included a clear description of changes and screenshots.
This demonstrates a professional Git workflow similar to real-world development teams.
-----------
This update was made using a feature branch and merged via Pull Request.
This update was made using a feature branch and merged via Pull Request.




