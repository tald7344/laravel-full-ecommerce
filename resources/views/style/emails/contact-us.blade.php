<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl" lang="ar">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title></title>
</head>

<body style="margin:unset;width: unset;">
<div class="table-responsive">
  <table class="table" style="font-size:17px;border:1px solid rgb(132,132,132);width: 99%;display: block;" dir="rtl">
    <tbody style="display: block">
    <tr style="border-bottom: 1px solid rgb(132,132,132);display: block;">
      <td align="right" style="padding: 10px;">
        <strong>
          الإتصال بنا
        </strong>
      </td>
    </tr>
    <tr style="border-bottom: 1px solid rgb(132,132,132);display: block;">
      <td align="right" style="padding: 10px;border-left: 1px solid rgb(132,132,132);display: inline-block;width: 46%;">
        <strong>
          {{ trans('auth.name')  }}
        </strong>
        &nbsp;&nbsp;:&nbsp;&nbsp;
        {!! $data['name'] !!}
      </td>
      <td align="right" style="padding: 10px;display: inline-block;width: 45%;">
        <strong>
          {{ trans('auth.email')  }}
        </strong>
        &nbsp;&nbsp;:&nbsp;&nbsp;
        {!! $data['email'] !!}
      </td>
    </tr>
    <tr style="border-bottom: 1px solid rgb(132,132,132);display: block;">
      <td align="right" style="padding: 10px;border-left: 1px solid rgb(132,132,132);display: inline-block;width: 46%;">
        <strong>
          {{ trans('auth.subject')  }}
        </strong>
        &nbsp;&nbsp;:&nbsp;&nbsp;
        {!! $data['subject'] !!}
      </td>
      <td align="right" style="padding: 10px;display: inline-block;width: 45%;">
        <strong>
          {{ trans('auth.message')  }}
        </strong>
        &nbsp;&nbsp;:&nbsp;&nbsp;
        {!! $data['message'] !!}
      </td>
    </tr>


    </tbody>
  </table>
</div>
<br><br>
<p style="text-align: center;">{{ config('app.name') }}</p>

</body>
</html>
