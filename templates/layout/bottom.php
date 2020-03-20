<div class="about-bg">
  <div class="container">
    <div class="about-wrap">
      <a href="" class="imgsp"><img src="" alt=""></a>
      <div class="info">
        <div class="about-head">
          <div class="about-head__img"><img src="assets/img/vechungtoi.png" alt="img"></div>
          <h2>Về chúng tôi</h2>
          <h5>Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi</h5>
        </div>
        <div class="about-body">
          Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi
          Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi
          Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi
          Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi
          Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi
          Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi Về chúng tôi
        </div>
        <a href="" class="xemtatca">Xem tất cả</a>
      </div>
    </div>
  </div>
</div>
<div class="tin-video-bg">
  <div class="container">
    <div class="tin-video-flex">
      <div class="video-bg">
        <div class="title"><span>Video clip</span></div>
        <div id="video-idx">
          <?php 
            $linkframe = 'https://www.youtube.com/watch?v=CJQnBPnBIcI';
           ?>
          <iframe id="iframe" src="https://www.youtube.com/embed/<?= getYoutubeIdFromUrl($linkframe) ?>"
           frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="video-khac-main">
          <?php foreach ($video as $key => $value) { 
              $iden = "";
              $img = "http://placehold.it/136x93";
            ?>
            <div class="video-khac"><a href="#" data-val="<?= $iden ?>"><img src="<?= $img ?>" alt=""></a></div>
          <?php } ?>
        </div>
      </div>
      <div class="tin-bg">
        <div class="title"><span>Tin tức mới</span></div>
        <?php 
        // if($c_tinnb > 0){ 
        if(1){ 
            $link = "";
            $img = "http://placehold.it/360x240";
          ?>
        <div class="first-news">
          <a href="<?= $link ?>">
            <img src="<?= $img ?>" alt="<?= $tinnb[0]["ten"] ?>">
            <div class="info">
              <h5><?= $tinnb[0]["ten"] ?>Tin tức mới Tin tức mới Tin tức mới</h5>
              <p><?= $tinnb[0]["mota"] ?>Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới</p>
              <span>Xem thêm</span>
            </div>
          </a>
        </div>
        <div class="tinnb-main">
          <?php foreach ($tinnb as $key => $value) { 
            $link = "";
            $img = "http://placehold.it/150x110";
            ?>
            <div class="tinnb-item"><a href="<?= $link ?>">
                <figure><img src="<?= $img ?>" alt="<?= $value["ten"] ?>"></figure>
                <div class="info">
                  <h5><?= $value["ten"] ?>Tin tức mới</h5>
                  <p><?= $value["mota"] ?>Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới</p>
                </div>
              </a></div>
          <?php } ?>
          <div class="tinnb-item"><a href="<?= $link ?>">
              <figure><img src="<?= $img ?>" alt="<?= $value["ten"] ?>"></figure>
              <div class="info">
                <h5><?= $value["ten"] ?>Tin tức mới</h5>
                <p><?= $value["mota"] ?>Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới</p>
              </div>
            </a></div>
            <div class="tinnb-item"><a href="<?= $link ?>">
                <figure><img src="<?= $img ?>" alt="<?= $value["ten"] ?>"></figure>
                <div class="info">
                  <h5><?= $value["ten"] ?>Tin tức mới</h5>
                  <p><?= $value["mota"] ?>Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới</p>
                </div>
              </a></div>
              <div class="tinnb-item"><a href="<?= $link ?>">
                  <figure><img src="<?= $img ?>" alt="<?= $value["ten"] ?>"></figure>
                  <div class="info">
                    <h5><?= $value["ten"] ?>Tin tức mới</h5>
                    <p><?= $value["mota"] ?>Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới Tin tức mới</p>
                  </div>
                </a></div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>