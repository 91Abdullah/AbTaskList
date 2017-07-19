{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="page-header">
        <h1>Create Task</h1>
    </div>

    {if $success == true}
        <div class="alert alert-success">
            Task has been created.
        </div>
    {/if}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Create a new task</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{url controller="ExampleModulePlainHtml" action="createTask" __csrf_token=$csrfToken}">
                <label class="col-sm-2 control-label" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" id="name">
                </div>

                <label class="col-sm-2 control-label" for="taskListId">Add to List</label>
                <div class="col-sm-10">
                    <select class="form-control" name="taskListId" id="taskListId">
                        {foreach $task_list as $list}
                            <option value="{$list.id}">{$list.id}</option>
                        {/foreach}
                    </select>
                </div>

                <label class="col-sm-2 control-label" for="done">Done</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="done" class="form-control" id="done">
                </div>

                <label class="col-sm-2 control-label" for="description">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description" id="description"></textarea>
                </div>

                <div class="col-sm-10">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    
{/block}