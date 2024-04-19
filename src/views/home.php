<?php
use Carbon\Carbon;

?>



  <header class="bg-white shadow">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <h1 class="text-3xl font-bold tracking-tight text-gray-900"><?= $header?></h1>
    </div>
  </header>
  <main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
      <!-- Your content -->
      <?php foreach($posts as $post) : ?>
        <div class="max-w-sm rounded overflow-hidden shadow-lg">
  <div class="px-6 py-4">
    <div class="font-bold text-xl mb-2"><a href="/posts/<?= $post['slug'] ?>"><?=$post['title'] ?></a></div>
    <p class="text-gray-700 text-base">
        <?= $post['content'] ?>
  </p>
  </div>
  <div class="px-6 pt-4 pb-2 flex justify-between">
    <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-bold text-gray-700 mr-2 mb-2 ">created by : <?= $post['username'] ?></span>
    <p class="font-thin"><?php
    $date = Carbon::parse($post['created_at']);
    echo $date->diffForHumans();
    ?></p>
  </div>
</div>
      <? endforeach; ?>
    </div>
  </main>
