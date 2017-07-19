<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{link file="backend/_resources/css/bootstrap.min.css"}">
</head>
<body role="document" style="padding-top: 80px">

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="test" class="navbar-brand" href="#">Task List</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li{if {controllerAction} === 'index'} class="active"{/if}><a href="{url controller="ExampleModulePlainHtml" action="index" __csrf_token=$csrfToken}">Home</a></li>
                <li{if {controllerAction} === 'create_list'} class="active"{/if}><a href="{url controller="ExampleModulePlainHtml" action="create_list" __csrf_token=$csrfToken}">Create list</a></li>
                <li{if {controllerAction} === 'task'} class="active"{/if}><a href="{url controller="ExampleModulePlainHtml" 
                action="task" __csrf_token=$csrfToken}">Task</a></li>
                <li{if {controllerAction} === 'create_task'} class="active"{/if}><a href="{url controller="ExampleModulePlainHtml" action="create_task" __csrf_token=$csrfToken}">Create Task</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container theme-showcase" role="main">
    {block name="content/main"}{/block}
</div> <!-- /container -->

<script type="text/javascript" src="{link file="backend/_resources/js/jquery-2.1.4.min.js"}"></script>
<script type="text/javascript" src="{link file="backend/_resources/js/bootstrap.min.js"}"></script>

{block name="content/layout/javascript"}
<script type="text/javascript">
    $(function() {

    });
</script>
{/block}
{block name="content/javascript"}{/block}
</body>
</html>