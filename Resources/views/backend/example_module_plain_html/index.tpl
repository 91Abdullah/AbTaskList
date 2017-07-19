{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="page-header">
        <h1>Task List</h1>
    </div>

    {if $success == true}
        <div class="alert alert-success">
            All Tasks have been marked as {if $done}done{else}undone{/if}.
        </div>
    {/if}

    {* {$params|@print_r} *}

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                {foreach $task_lists as $list}
                    <tr>
                        <td>{$list.id}</td>
                        <td class="text-center">
                            {* <a href="{url id=$list.id action='showTask' controller='ExampleModulePlainHtml' __csrf_token=$csrfToken}">
                                <span class="glyphicon glyphicon-search"></span>
                            </a> *}
                            <form style="display:inline;" class="inline-form" method="post" action="{url id=$list.id controller='ExampleModulePlainHtml' __csrf_token=$csrfToken}">
                                <button style="margin-left:20px;" class="btn btn-primary">
                                    <span class="gylphicon gylphicon-ok"></span> Mark all as done
                                </button>
                            </form>
                            <form style="display:inline;" class="inline-form" method="post" action="{url form_method='mark_undone' id=$list.id controller='ExampleModulePlainHtml' __csrf_token=$csrfToken}">
                                <button style="margin-left:20px;" class="btn btn-danger">
                                    <span class="gylphicon gylphicon-ok"></span> Mark all as undone
                                </button>
                            </form>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/block}