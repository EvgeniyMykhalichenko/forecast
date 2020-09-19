### Forecast laravel package

#### Install package

`$ composer install krepysh/forecast`

#### Publiсh Forecast config file
`$ php artisan vendor:publish --provider="Krepysh\Forecast\ForecastServiceProvider"`

#### Add configs to .env file

`FORECAST_API_KEY=You api key`
`FORECAST_API_VERSION=v1`

#### Use example

    <?php
		//Create instance
         $forecast = new Forecast();
		 
		 //Get all projects
         $forecast::projects()->getAll();
    ?>
