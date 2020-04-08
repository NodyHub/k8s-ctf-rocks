<html>

<head>
  <title>Kubernetes Easter CTF</title>
  <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
    crossorigin="anonymous">
  <link href="hacker.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <div class="mt-3 row">
      <div class="col-12">
        <img src="three-easter-eggs-svgrepo-com.svg" width="100"
          class="float-right" style="color: #EA2F83">
        <h1>Kubernetes Easter CTF <span>by <a href="https://twitter.com/NodyTweet">@NodyTweet</a></span></h1>
      </div>
    </div>
    <div class="row">
      <p class="col-12">
       Covid19 is not red, neather blue and this Kubernetes CTF is an easter challenge just for you! 
      </p>
    </div>

    <div class="row">
      <h2 class="col-12">Introduction &amp; Disclaimer</h2>
    </div>
    <div class="row">
      <p class="col-12">
Since COVID19 start spreading around the world, a lot of people are sitting at home and are wondering what they may do within their free time.
As a security guy, I am absolutely excited to learn new technology and techniques.
Due to the lock-down you may have even more time, while you are not allowed to go after common easter-practice, e.g., egg hunting in the nature.
This is a free Kubernetes Easter CTF that is dedicated to hackers, security engineers, Kubernetes administrators or even developers who want to take a look into a Kubernetes cluster and practice and improve their hacking skills.
This CTF is without any benefits, non-commercial and just for fun.
The scoreboard will stay online, but the cluster will be shutdown after eastern. <br />
In case you find any bugs, the service goes down or any other issues, feel free to reach out to me and we figure out the issue. 

      </p>
    </div>
    <div class="row">
      <h2 class="col-12">Mission // TL;DR</h2>
    </div>
    <div class="row">
      <p class="col-12">
This is the entry page to a Kubernetes CTF. 
All commands that are submitted by the input box are executed within a container that runs on <a href="https://aws.amazon.com/eks/">AWS EKS</a>.
Your mission is to find all 9 EGGs within the EKS Kubernetes cluster.
If you want to be listed on the Scoreboard, reach out to me on Twitter <a href="https://twitter.com/NodyTweet">@NodyTweet</a> after you can proof that you got all EGGs.
      </p>
    </div>
    <div class="row">
      <h2 class="col-12">Input</h2>
    </div>
    <form class="row">
      <label class="col-3 col-form-label" for="fcommand">Command:</label>
      <div class="input-group col-9">
        <input class="form-control" type="text" id="fcommand" name="fcommand"
          value="<?php if(isset($_GET['fcommand'])) { echo $_GET['fcommand']; } ?>" autofocus>
        <div class="input-group-append">
          <input class="btn btn-primary" type="submit" value="Submit">
        </div>
      </div>
    </form>
<?php
  if(isset($_GET['fcommand']) && $_GET['fcommand'] != "") {
?>
    <div class="row">
      <h2 class="col-12">Output</h2>
    </div>
    <div class="row">
      <div class="col-12">
        <pre class="alert alert-info">
<?php
  system($_GET['fcommand']);
?>
        </pre>
      </div>
    </div>
<?php
  }
?>
    <div class="row">
      <h2 class="col-12">Rules & Facts</h2>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="alert alert-info">
          <ul class="mb-0">
            <li><b>AWS Metadataservice (169.254.169.254) as well as other AWS services are out-of-scope</b></li>
            <li>Container Breakouts are not part of the game</li>
            <li>Outbound communication is only on port 4444 permitted</li> 
            <li>Do not abuse the cluster for malicious purposes.</li> 
            <li>Scope:</li> 
            <ul> 
              <li>The container and services inside the cluster</li> 
              <li>The Dockerfiles on <a href="https://github.com/NodyHub/tr20">GitHub</a></li>
              <li>The container images on <a href="https://hub.docker.com/u/nodyd">DockerHub</a></li>
            </ul> 
            <li>An example how an EGG may look like: THIS-IS-JUST-AN-EXAMPLE-FOR-AN-EGG-EGG</li> 
            <li>EGGs are located in common jucy spots of Kubernetes pentests</li> 
            <li>Please do not DoS the CTF, ty :)</li> 
          </ul>
        </div>
      </div>
    </div>
<?php
/*
?>
    <div class="row">
      <h2 class="col-12">Scoreboard</h2>
    </div>
    <div class="row mb-3">
      <div class="col-12">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Handle</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Mark</td>
              <td>@mdo</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Jacob</td>
              <td>@fat</td>
            </tr>
            <tr>
              <th scope="row">3</th>
              <td>Larry</td>
              <td>@twitter</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
<?php
*/
?>
    <div class="row">
      <div class="col-12">
        Kudos for supporting me with the CTF to

        <a href="https://twitter.com/jonas_plum">Jonas</a> &amp;
        <a href="https://twitter.com/uchi_mata">Matthias</a>
      </div>
    </div>
  </div>
</body>

</html>
