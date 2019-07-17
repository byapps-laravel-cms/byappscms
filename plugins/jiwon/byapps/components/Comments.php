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

  // public $mmid = [
  //   'apps', 'csqna', 'design_order', 'free_order',
  //   'ma', 'member', 'myqna', 'new_update',
  //   'order', 'payment', 'promotion', 'retaku', 'reseller',
  //   'work'
  // ];

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

          'target' => [
              'title'       => '대상 테이블',
              'description' => '코멘트 대상 테이블',
              'type'        => 'dropdown',
              'default'     => 'apps'
          ]
      ];
  }

  public function getTargetOptions() {
      return [
        'apps' => '앱 접수',
        'csqna'=> '고객 문의',
        // 'design_order' => '',
        // 'free_order' => '',
        'ma' => '부가서비스 접수',
        'member' => '회원 문의',
        'myqna' => '고객 상담',
        'new_update' => '업데이트 관리',
        'order' => '기타 서비스',
        'payment' => '결제 관리',
        'promotion' => '프로모션',
        // 'retaku' => '',
        'reseller' => '리셀러 정보',
        // 'work' => ''
      ];
  }


  public function onRun()
  {
     $this->comments = $this->loadComments();
  }

  protected function loadComments() {

     $query = Comment::query();

     if (!empty($this->property('display'))) {
       //$query = $query->limit($this->property('display'));
       $query = $query->where('mmid', '=', $this->property('target'))->limit($this->property('display'));
     }

     //return Comment::all()->take(10)->sortBy('idx');
     $query = $query->get()->sortByDesc('idx');
     return $query;
  }
}
?>
