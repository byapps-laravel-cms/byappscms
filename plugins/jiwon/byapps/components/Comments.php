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
          'redirect' => [
              'title'       => /*Redirect to*/'redirect_to',
              'description' => /*Page name to redirect to after update, sign in or registration.*/'redirect_to_desc',
              'type'        => 'dropdown',
              'default'     => ''
          ],
      ];
  }

  public function onRun()
  {
     // $comment = Comment::where('idx', 106982)->first();
     //  // var_dump($comment["comment"]);
     // $this->page['comments'] = $comment['comment'];
     //  //return $this->page['comments'] = $comment;

     $this->comments = $this->loadComments();

  }

  protected function loadComments() {
     return Comment::all();
  }
}
?>
