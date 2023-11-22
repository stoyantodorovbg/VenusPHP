<h1>{$title|escape}</h1>
<ul>
    {foreach $cities as $city}
        <li>{$city.name|escape} ({$city.population})</li>
        {foreachelse}
        <li>no cities found</li>
    {/foreach}
</ul>

<a href="{'web-test-test'|urlById}">Link</a>