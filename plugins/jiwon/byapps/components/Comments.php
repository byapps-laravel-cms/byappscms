<?php
namespace Jiwon\Byapps\Components;

use Auth;
use Event;
use Flash;
use Input;
use Session;
use Request;
use Redirect;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Exception;
use Jiwon\Byapps\Models\Comment;

class Comments extends ComponentBase
{
  public $comments;

  public function componentDetails()
  {
      return [
          'name'        => 'Comment List',
          'description' => '댓글 목록'
      ];
  }

  public function defineProperties()
  {
      return [
          'display' => [
              'title'       => '표시할 코멘트 수',
              'description' => '몇 개까지 코멘트를 표시할까요',
              'default'     => 10,
              'validationPattern' => '^[0-9]+$',
              'validationMessage' => '숫자만 적어주세요'
          ],
      ];
  }

  public function onRun()
  {
     $this->comments = $this->loadComments();
  }

  protected function loadComments() {

     $query = Comment::all();

     if ($this->property('display') > 0) {
       $query = $query->take($this->property('display'));
     }

     //return Comment::all()->take(10)->sortBy('idx');
     return $query;
  }
}
?>
