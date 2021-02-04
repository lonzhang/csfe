
// @click.stop="$utils.hideElImage"
function hideElImage() {
    // 获取遮罩层dom
    setTimeout(function () {
        let domImageMask = document.querySelector(".el-image-viewer__mask");
        console.log(domImageMask)
        if (!domImageMask) {
            return;
        }
        domImageMask.addEventListener("click", () => {
            // 点击遮罩层时调用关闭按钮的 click 事件
            document.querySelector(".el-image-viewer__close").click();
        });
    },500)
}

// 存储切换路由

export default{
    hideElImage
}
