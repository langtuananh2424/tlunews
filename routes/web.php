<?php
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');