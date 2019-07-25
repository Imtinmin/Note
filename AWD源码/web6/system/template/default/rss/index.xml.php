<rss version="2.0">
<channel>
  <title>{$title}</title>
  <link>{$siteLink}</link>
  <description>{$desc}</description>
  <copyright>{!echo $config->company->name . $config->site->copyright . '-' . date('Y')}</copyright>
  <lastBuildDate>{$lastDate}</lastBuildDate>
  
  {foreach($articles as $article)}
    {$category = current($article->categories)}
    {$article->content = str_replace('src="/file.php', 'src="' . $sysURL . '/file.php', $article->content)}
    {$article->content = str_replace("src='/file.php", "src='" . $sysURL . '/file.php', $article->content)}
    <item>
      <title>{$article->title}</title>
      <description><![CDATA[  {$article->content}]]></description>
      <link>{!str_replace('&', '&amp;', $siteLink . $control->createLink('blog', 'view', "id=$article->id", "category={{$category->alias}}&name=$article->alias", 'html'))}</link>
      <category>{$category->name}</category>
      <pubDate>{!echo $article->addedDate . ' +0800'}</pubDate>
    </item>
  {/foreach}
</channel>
</rss>
