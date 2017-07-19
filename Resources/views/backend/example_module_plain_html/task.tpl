{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="page-header">
        <h1>Tasks</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Done</th>
                    <th>Description</th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody>
                {foreach $tasks as $task}
                    <tr>
                        <td>{$task.id}</td>
                        <td>{$task.name}</td>
                        <td>
                            {if $task.done}
                                <span class="glyphicon glyphicon-ok" style="color:green"></span>
                            {else}
                                <span class="glyphicon glyphicon-remove" style="color:red"></span>
                            {/if}
                        </td>
                        <td>{$task.description}</td>
                        <td><a href="{url id=$task.id action='edit_task' controller='ExampleModulePlainHtml' __csrf_token=$csrfToken}"><span class="glyphicon glyphicon-pencil"></span></a></td>
                    </tr>
                {/foreach}
            </tbody>
            <tfoot>
                <tr class="active">
                    <td colspan="4">
                        <strong>Total:</strong> {$totalTasks} task(s)
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
{/block}