class DoctorsController < ApplicationController
    def index
        @doctor = Doctor.all
    end
    
    def show
        @doctor = Doctor.find(params[:id])
    end
    
    def new
        @doctor = Doctor.new
    end
    
    def edit
        @doctor = Doctor.find(params[:id])
    end
    
    def create
        @doctor = Doctor.new(doctors_params)
        
        if @doctor.save
            redirect_to @doctor
        else
            render 'new'
        end
    end
    
    def update
        @doctor = Doctor.find(params[:id])
        
        if @doctor.update(doctors_params)
            redirect_to @doctor
        else
            render 'edit'
        end
    end
    
    def destroy
        @doctor = Doctor.find(params[:id])
        @doctor.destroy
        
        redirect_to doctors_path
    end
    
    private
        def doctors_params
            params.require(:doctor).permit(:name, :description, :location)
        end
end
