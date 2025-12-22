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
I added a GitHub Actions workflow to automatically build the Docker image on every push, ensuring continuous integration and early detection of build issues.
