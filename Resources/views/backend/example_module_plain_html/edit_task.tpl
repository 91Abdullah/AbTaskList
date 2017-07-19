{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="page-header">
        <h1>Edit Task</h1>
    </div>

    {if $success == true}
        <div class="alert alert-success">
            Task has been updated.
        </div>
    {/if}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Edit Task # {$task->getId()}</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{url id=$task->getId() controller="ExampleModulePlainHtml" action="editTask" __csrf_token=$csrfToken}">
                <label class="col-sm-2 control-label" for="name">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="{$task->getName()}" id="name">
                </div>

                <label class="col-sm-2 control-label" for="taskListId">Add to List</label>
                <div class="col-sm-10">
                    <select class="form-control" name="taskListId" id="taskListId">
                        {foreach $task_list as $list}
                            <option value="{$list.id}" {if $selected->getId() == $list.id}selected{/if}>{$list.id}</option>
                        {/foreach}
                    </select>
                </div>
 
                <label class="col-sm-2 control-label" for="done">Done</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="done" class="form-control" id="done" {if $task->getDone()}checked{/if}>
                </div>

                <label class="col-sm-2 control-label" for="description">Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" name="description" id="description">{$task->getDescription()}</textarea>
                </div>

                <div class="col-sm-10">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>   
            </form>
        </div>
    </div>
    
{/block}