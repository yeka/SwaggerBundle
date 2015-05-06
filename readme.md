Usage
=====

Add YekaSwaggerBundle in your ```app/AppKernel.php```

```
$bundles[] = new Yeka\SwaggerBundle\YekaSwaggerBundle();
```

Add this is config.yml

```
yeka_swagger:
    bundles: [YourBundle]
```

And define in your routing.yml where the swagger should show

```
yeka_swagger:
    resource: "@YekaSwaggerBundle/Resources/config/routing.yml"
    prefix:   /api
```

Now you can start adding swagger's annotations in your controllers and enjoy the result