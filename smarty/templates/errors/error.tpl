{extends file='errors/main.tpl'}

{block name=content}
    <div>
        <h1>{$code|escape}</h1>
        <p>
            {$message|escape}
        </p>
    </div>
{/block}