//base
(function(){
  //检查curr menu
  $('nav#left a[href]').each(function(){
    if( location.pathname == $(this).attr('href') ){
      $(this).addClass('curr');
    }
  });

})();



//表单控件
(function(){
  //富文本编辑
  $('textarea.rich').each(function(){
    CKEDITOR.replace(this,{
      width:600,
      height:300,
      filebrowserImageUploadUrl: '/index.php?s=/Backer/Model/upload',
    });
  });


  //日期选择（强制桥接到Unix timestamp）
  $('input.datepicker').pickadate({
    monthsFull: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    monthsShort: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
    weekdaysShort: ['日', '一', '二', '三', '四', '五', '六'],
    showMonthsShort: true,
    labelMonthNext: '下个月',
    labelMonthPrev: '上个月',
    labelMonthSelect: '选择月份',
    labelYearSelect: '选择年份',
    clear: '重置',
    close: '关闭',
    editable: false,
    min: undefined,
    max: undefined,
    selectMonths: true,
    //hiddenSuffix: '_submit',
    min: new Date(),
    format:'yyyy/mm/dd',
    formatSubmit:'yyyy/mm/dd',
    onStart:function(){
      //unix 时间戳处理
      var v = this.get();
      if( v.match(/^\d{10}$/) ){
        this.set('select',v*1000);
      }
    },
  });

})();




//Filter控件
(function(){

  //tab控件
  $('form#filter .tab').on('click','a',function(){
    $t = $(this).attr('value')
    $i = $(this).siblings('input[type=hidden]').val();
    $(this).siblings('input[type=hidden]').val($t===$i ? null : $t);
    $(this).parents('form').submit();
  });
  //检查curr
  $('form#filter .tab a').each(function(){
    if( location.search.indexOf($(this).attr('name')+'='+$(this).attr('value')) >= 0 ){
      $(this).addClass('curr');
    }
  });


  $('form#filter .input .clear').click(function(){
    $(this).siblings('input').val(null);
    $(this).parents('form').submit();
  });
  
})();