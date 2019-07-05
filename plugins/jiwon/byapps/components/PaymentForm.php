<?php
namespace Jiwon\Byapps\Components;

use Lang;
use Auth;
use Event;
use Flash;
use Input;
use Request;
use Redirect;
use Validator;
use ValidationException;
use ApplicationException;
use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Exception;
use Jiwon\Byapps\Models\PaymentData;

class PaymentForm extends ComponentBase
{
  public function componentDetails()
  {
      return [
          'name'        => 'PaymentForm',
          'description' => 'PaymentForm component'
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

  public function getRedirectOptions()
  {
      return [''=>'- refresh page -', '0' => '- no redirect -'] + Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
  }

  public function onRun()
  {
      /*
       * Redirect to HTTPS checker
       */
      if ($redirect = $this->redirectForceSecure()) {
          return $redirect;
      }
  }

  public function onUpdate()
  {
      $paymentData = PaymentData::where('idx', Input::get('idx'))->first();

      $paymentData->receipt = Input::get('receipt');

      $paymentData->save();

      Flash::success('업데이트 성공');

      /*
       * Redirect
       */
      if ($redirect = $this->makeRedirection(true)) {
          return $redirect;
      }
      //
      // $this->prepareVars();
  }

  /**
   * Redirect to the intended page after successful update, sign in or registration.
   * The URL can come from the "redirect" property or the "redirect" postback value.
   * @return mixed
   */
  protected function makeRedirection($intended = false)
  {
      $method = $intended ? 'intended' : 'to';
      $property = $this->property('redirect');
      if (!strlen($property)) {
          return;
      }

      $redirectUrl = $this->pageUrl($property) ?: $property;
      //echo $redirectUrl;

      if ($redirectUrl = post('redirect', $redirectUrl)) {
         return Redirect::$method($redirectUrl);
      }
  }

  /**
   * Checks if the force secure property is enabled and if so
   * returns a redirect object.
   * @return mixed
   */
  protected function redirectForceSecure()
  {
      if (
          Request::secure() ||
          Request::ajax() ||
          !$this->property('forceSecure')
      ) {
          return;
      }

      return Redirect::secure(Request::path());
  }
}
?>
