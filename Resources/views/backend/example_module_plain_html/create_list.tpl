{extends file="parent:backend/_base/layout.tpl"}

{block name="content/main"}
    <div class="page-header">
        <h1>Create list</h1>
    </div>

    {if $success == true}
        <div class="alert alert-success">
            List has been created.
        </div>
    {/if}

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Create a new list</h3>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{url controller="ExampleModulePlainHtml" action="createList" __csrf_token=$csrfToken}">
                <div class="col-sm-10">
                    <button class="btn btn-primary" type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
    
{/block}