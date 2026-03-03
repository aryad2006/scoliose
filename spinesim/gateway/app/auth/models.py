"""
Modèles Pydantic pour l'authentification.
"""

from pydantic import BaseModel, EmailStr, Field


class LoginRequest(BaseModel):
    username: str = Field(..., min_length=3, max_length=64)
    password: str = Field(..., min_length=6, max_length=128)


class RegisterRequest(BaseModel):
    username: str  = Field(..., min_length=3, max_length=64)
    email: EmailStr
    password: str  = Field(..., min_length=8, max_length=128)
    full_name: str = Field("", max_length=128)
    role: str      = Field("student", pattern=r"^(student|instructor|admin)$")


class TokenResponse(BaseModel):
    access_token: str
    refresh_token: str
    token_type: str = "bearer"
    expires_in: int   # secondes


class RefreshRequest(BaseModel):
    refresh_token: str


class UserInfo(BaseModel):
    id: str
    username: str
    email: str
    full_name: str
    role: str
    is_active: bool
