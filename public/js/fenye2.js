function fenye(){
  if(totalPage >1)
    {
        var objHtml = '';
        if(currPage > 1)
        {
            objHtml += '<a class="page_up pageup" flg="up" href="javascript:void(0)"> 上一页</a>';
        }
        var groupSize = 8;
        var startindex = Math.floor(currPage / groupSize) * groupSize + 1;
        if(currPage % groupSize == 0)
        {
            startindex = currPage;
        }
        var endindex = startindex + groupSize - 1;
        if(endindex > totalPage)
        {
            endindex = totalPage;
        }
        for(var i = startindex; i <= endindex; i++)
        {
            if(i == currPage)
            {
                objHtml += '<a class="show gopage" ';
            }else
            {
                objHtml += '<a class="gopage" ';
            }
            objHtml += ' goto="'+i+'" href="javascript:void(0)">' + i + '</a>';
            
        }
        if(currPage < totalPage)
        {
            objHtml += '<a class="page_down pageup" flg="down" target="_self" href="javascript:void(0)">下一页</a>';
        }
        
        
        $("#pagination").html(objHtml);
    }else{
    	$("#pagination").html("");
    } 
}
$(".gopage").live("click",function(){
    var page = $(this).attr("goto");
    loaddata(page);
});

$(".pageup").live("click",function(){
    var flg = $(this).attr("flg");
    var page;
    if(flg == "up")
    {
        page = currPage - 1;
    }else
    {
        page = currPage + 1;
    }
    loaddata(page);
});