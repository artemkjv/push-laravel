## Api

### 1. /apps/{uuid}/show - GET
Response:
```json
{
    "data":{
        "sender_id":"xxxxxxxxxxx"
    }
}
```

Description:
* Получаем sender_id, который используем для инициализации fcm

### 2. /api/push-users - POST

Parameters:
- registration_id
- uuid
- app_id
- platform_id {Android - 1, IOS - 2, Web - 3}
- country {UA}
- language {ua}
- timezone {Europe/Kiev}
- device_model(optional)

Response: Empty Response

Description:
* Отсылаем запрос только при первом открытии приложения и сохраняем
  registration_id в кеш

### 3. /api/push-users/{registrationId}/session - GET
Response: Empty Response

Description:
* Отсылаем каждый раз при открытии приложения


### 4. /api/push-users/{registrationId} - PATCH
Parameters:
- registration_id

Response: Empty Response

Description:
* Отсылаем при обновление fcm токена

### 5. /api/push-users/{registrationId}/tag - PATCH
Parameters:
- key
- value

Response: Empty Response 

Description:
* Роут для добавления пользовательских тегов push юзеру

### 6. /api/push-users/{registrationId}/time - PATCH
Parameters:
- time_in_app

Response:   

Description:
* Отсылаем время(в секундах) проведённое пользователем в приложении

### 7. /api/push-users/{registrationId}/transition - PATCH
Parameters:
- push_type
- push_id

Response: Empty Response

Description:
* Отсылаем каждый раз при переходе по пушу
