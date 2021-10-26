<script type="text/javascript">
<!--
	var baseDir = '{$base_dir_ssl}';
-->
</script>

{capture name=path}<a href="{$base_dir_ssl}my-account.php">{l s='My account'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='Your downloads' mod='alldownloads'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}
<h2>{l s='Your downloads' mod='alldownloads'}</h2>





{foreach from=$products2 key=key item=item}
  
    {foreach from=$item item=i key=k}
   
   
{if $psversion < "1.5.0.0"}
      <a href="{$link->getPageLink('get-file.php', true)}?key={$i.physically_filename|escape:'htmlall':'UTF-8'}-{$i.download_hash|escape:'htmlall':'UTF-8'}" title="{l s='download this product' mod='alldownloads'}" class="a-btn">
      {else}
        <a href="{$link->getPageLink('get-file.php', true)}?key={$i.filename|escape:'htmlall':'UTF-8'}-{$i.download_hash|escape:'htmlall':'UTF-8'}" title="{l s='download this product' mod='alldownloads'}" class="a-btn">
      {/if}
    	<span class="a-btn-symbol">Z</span>
						<span class="a-btn-text">{l s='Download' mod='alldownloads'}: {$i.product_name|truncate:20:'...'}</span>  
						<span class="a-btn-slide-text">{l s='Expires' mod='alldownloads'} {$i.download_deadline} - {l s='Order ID' mod='alldownloads'}:{$i.id_order}</span>    
						<span class="a-btn-slide-icon"></span>
      
      </a> 
      
      
 
         
    {/foreach}
{/foreach}
