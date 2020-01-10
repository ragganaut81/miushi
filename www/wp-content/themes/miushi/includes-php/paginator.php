<?php
// Пагинатор
function paginator( $count_pages = 50, $active = 15, $url = "/post", $url_page='/post?page=' ){
    /* Входные параметры */
    //$count_pages = 50;
    //$active = 15;
    $count_show_pages = 20;
    //$url = "/index.php";
    //$url = "/monument";
    //$url_page = "/index.php?page=";
    if ($count_pages > 1) { // Всё это только если количество страниц больше 1
        /* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине, если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если количество страниц недостаточно) */
        $left = $active - 1;
//      $right = $count_pages - $active;
        if ($left < floor($count_show_pages / 2)) $start = 1;
        else $start = $active - floor($count_show_pages / 2);
        $end = $start + $count_show_pages - 1;
        if ($end > $count_pages) {
            $start -= ($end - $count_pages);
            $end = $count_pages;
            if ($start < 1) $start = 1;
        }

        ?>
        <!-- Дальше идёт вывод Pagination -->


        <?php
	    $theme = get_template_directory();
        ?>

        <div class="tablenav bottom">
            <div class="tablenav-pages">

			    <?php if ($active != 1) { ?>
				    <?php /* ?><a href="<?=$url?>" title="Первая страница" class="first-page">«</a><?php */ ?>
                    <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница" class="a prev-page">Назад</a>
			    <?php } else { ?>
				    <?php /* ?><a href="<?=$url?>" title="Первая страница" class="first-page disabled">«</a><?php */ ?>
                    <a href="<?php if ($active == 2) { ?><?=$url?><?php } else { ?><?=$url_page.($active - 1)?><?php } ?>" title="Предыдущая страница" class="a prev-page disabled">Назад</a>
			    <?php } ?>

			    <?php for ($i = $start; $i <= $end; $i++) { ?>
				    <?php if ($i == $active) { ?>
                        <a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>" class="a page disabled"><?=$i?></a>
				    <?php } else { ?>
                        <a href="<?php if ($i == 1) { ?><?=$url?><?php } else { ?><?=$url_page.$i?><?php } ?>" class="a page"><?=$i?></a>
				    <?php } ?>
			    <?php } ?>

			    <?php if ($active != $count_pages) { ?>
                    <a href="<?=$url_page.($active + 1)?>" title="Следующая страница" class="a next-page"><span class="svg-icon icon-w"><?php include ($theme."/images/icon-svg/icon-arrow-next.svg"); ?></span></a>
				    <?php /* ?><a href="<?=$url_page.$count_pages?>" title="Последняя страница" class="end-page">»</a> <?php */ ?>
			    <?php } else { ?>
                    <a href="<?=$url_page.($active + 1)?>" title="Следующая страница" class="a next-page disabled"><span class="svg-icon icon-w"><?php include ($theme."/images/icon-svg/icon-arrow-prev.svg"); ?></span></a>
				    <?php /* ?><a href="<?=$url_page.$count_pages?>" title="Последняя страница" class="end-page disabled">»</a> <?php */ ?>
			    <?php } ?>

            </div>
        </div>

    <?php }
}


// 31 октября 2017
class paginator{
	protected $showPages;
	protected $countPages;
	protected $active;
	protected $baseUrl;
	protected $pageParamUrl;

    protected $textFirstLink;
    protected $textPrevLink;
    protected $textNextLink;
    protected $textLastLink;

	function __construct() {
		$this->showPages        = 5;
		$this->countPages       = 50;
		$this->active           = 15;
		$this->baseUrl          = "/post";
		$this->pageParamUrl     = "/?page=";

		$this->textFirstLink    = "«";
		$this->textPrevLink     = "←";
		$this->textNextLink     = "→";
		$this->textLastLink     = "»";
	}

	function setParam ($array){
		foreach ( $array as $param => $value ) {
		    //var_dump( isset( $this[$param] ) );
			if ( isset( $this->$param ) ):
				$this->$param = $value;
			else:
				echo "Не известный параметр {$param}";
				//throw new Exception("Не известный параметр {$param}");
			endif;
		}
		return;
	}

    function getHtml(){

	    if ($this->countPages > 1) { // Всё это только если количество страниц больше 1
		    /* Дальше идёт вычисление первой выводимой страницы и последней (чтобы текущая страница была где-то посредине, если это возможно, и чтобы общая сумма выводимых страниц была равна count_show_pages, либо меньше, если количество страниц недостаточно) */
		    $left = $this->active - 1;
//      $right = $count_pages - $active;
		    if ( $left < floor( $this->showPages / 2 ) ) {
			    $start = 1;
		    } else {
			    $start = $this->active - floor( $this->showPages / 2 );
		    }
		    $end = $start + $this->showPages - 1;
		    if ( $end > $this->countPages ) {
			    $start -= ( $end - $this->countPages );
			    $end   = $this->countPages;
			    if ( $start < 1 ) {
				    $start = 1;
			    }
		    }
	    }



        // Первая часть

        $output = '';
        $output .= '<ul class="paginator">';

        switch ( $this->active ){
            case 1:
	            $disable = 'disable';
	            $link = $this->baseUrl;
                break;
            case 2:
	            $disable = '';
	            $link = $this->baseUrl;
                break;
            default:
	            $disable = '';
	            $link = $this->baseUrl.$this->pageParamUrl.($this->active - 1);
                break;
        }


	    $output .= "<li class='prev-page {$disable}'><a href='{$link}' title='Предыдущая страница' class='a'>{$this->textPrevLink}</a></li>";

        if ( $this->active - floor($this->showPages/2) > 0 ):
	        $output .= "<li class='first-page {$disable}'><a href='{$this->baseUrl}' title='Первая страница' class='a'>{$this->textFirstLink}</a></li>";
        endif;

        // Средняя часть

        for ($i = $start; $i <= $end; $i++):

	        if ($i == 1):
		        $link = $this->baseUrl;
            else:
	            $link = $this->baseUrl.$this->pageParamUrl.$i;
            endif;

	        if ( $this->active == $i):
		        $active = 'active';
	        else:
		        $active = '';
	        endif;

	        $output .= "<li class='page page-{$i} {$active}'><a href='{$link}' class='a'>{$i}</a></li>";

	    endfor;

        // Последняя часть
	    switch ( $this->active ){
		    case $this->countPages:
			    $disable = 'disable';
			    $link = $this->baseUrl.$this->pageParamUrl.$this->countPages;
			    break;
		    default:
			    $disable = '';
			    $link = $this->baseUrl.$this->pageParamUrl.($this->active + 1);
			    break;
	    }


	    if ( $this->active + floor($this->showPages/2) < $this->countPages ):
	        $output .= "<li class='last-page {$disable}'><a href='{$this->baseUrl}{$this->pageParamUrl}{$this->countPages}' title='Последняя страница' class='a'>{$this->textLastLink}</a></li>";
        endif;

        $output .= "<li class='next-page {$disable}'><a href='{$link}' title='Следующая страница' class='a'>{$this->textNextLink}</a></li>";


	    $output .= "</ul>";

        return $output;

    }

    function html(){
        echo $this->getHtml();
    }

}