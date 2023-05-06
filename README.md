# Azubi_CloudProjects
Cloud projects by Azubi

Version1
Create a simple HTML form.

fire up your ide prefarably VScode<br>
create a folder and cd into it. inside the folder create a file and name it index.html, write a simple static html form code snippet.<br><br>
create a docker file and name it Dockerfile without any extension.<br>
push your code to github.<br>
Use the docker image build command to create a image using the instructions in the Dockerfile.<br>
Use the docker run command to start a new container from the image you created.<br><br>
If done properly you should see you app running on port 80 on localhost<br><br><br>
Finally push your image to Docker Hub.<br>
From Docker Hub anyone can pull and run the exact copy of your app on any computer.<br>



Version2
Push Your image to Amazon ECR and create a cluster with a task definition<br><br>
In this version we will create a frontend html form and a backend simple code snippet in php programming language.<br>
The backend only needs to get the post request from the frontend html form and send back a response to the frontend when a post request with the correct credentials is successful or not.
Once again following the same steps as the version1 we build an image from the instruction in the dockerfile expose it to port 80 and so on...
create an Amazon ECR repository, tag and push your image to the repo.<br>
create a task defenition on Amazon ECS attach an execution role to it also point it to your image in the repository.<br><br>
create a cluster and a service and point it to the task definition.<br>
click the task tab, click your created task, check for the public ip address, paste it in the browser, you should see you app running. Do not forget to tear down all the infrastructure created when you are done.<br>
