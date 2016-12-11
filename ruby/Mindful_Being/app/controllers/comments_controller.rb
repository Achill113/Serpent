class CommentsController < ApplicationController
  def index
  	@comment = Comment.all
  end

  def create
    @article = Article.find(params[:id])
    @comment = @article.comments.create(comment_params)
    if @comment.save
    	redirect_to @article
    else
    	flash.now[:danger] = "error"
    end
  end
 
  private
    def comment_params
      params.require(:comment).permit(:commenter, :body)
    end
end