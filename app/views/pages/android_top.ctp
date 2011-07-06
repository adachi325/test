
<body id="top">
<div id="wrap" data-role="page" data-theme="d">
<div id="header">
	<?php echo $this->Html->image("logo.gif", array("alt" => "ケータイしまじろうひろば×ドコモコミュニティ", "width" => "320", "height" => "83")); ?>
</div>

<div id="main">
	<p>	Android端末では、&lt;こどもちゃれんじ&gt;教材との連動コンテンツの一部がお楽しみいただけます。</p>
	<dl id="contents">
		<?php foreach ( $lineData as $lineKey => $line  ) : ?>
		    <dt>
				<?php echo $this->Html->image( "icn_" . $line['Line']['category_name'] . ".gif", array() ); ?>
				<?php echo $this->Html->image( "txt_" . $line['Line']['category_name'] . ".gif", array( "alt" => "こどもちゃれんじ " . $line['Line']['category_name'] . "/ぷちファースト" ) ); ?><br />
				<span class="<?php echo $line['Line']['category_name']; ?>"><?php echo substr( $line['Line']['title'] , 0 , 14 ); ?> コース</span>
				<?php foreach ( $contentData as $contentKey => $content ) : ?>
					<?php if ( $content['Content']['line_id'] == $lineKey + 1 ): ?>
						<dd>
							<a href="<?php echo $this->Html->url( '/' . $content['Content']['path'] . '/' );?>" data-role="button" data-theme="e" rel="external">
								<?php echo $content['Content']['title']; ?>
							</a>
					    </dd>
				    <?php endif; ?>
			    <?php endforeach; ?>
		    </dt>
		<?php endforeach; ?>
	</dl>
	<hr id="orangeDot">
	<p>なお、Android向けサービスは今後バージョンアップを予定しております。ご期待ください。</p>
</div>
