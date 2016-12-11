class Article < ActiveRecord::Base
    acts_as_commontator
    validates :title, presence: true
end
