__int64 __fastcall sub_4005B7(const char *a1, __int64 a2)
{
  int v2; // eax
  int v3; // eax
  int v4; // eax
  int v5; // ST18_4
  int v6; // eax
  int v7; // eax
  int v8; // eax
  int v10; // [rsp+10h] [rbp-10h]
  unsigned __int8 v11; // [rsp+17h] [rbp-9h]
  unsigned __int8 v12; // [rsp+17h] [rbp-9h]
  int v13; // [rsp+18h] [rbp-8h]
  int v14; // [rsp+18h] [rbp-8h]
  int v15; // [rsp+18h] [rbp-8h]
  int v16; // [rsp+1Ch] [rbp-4h]

  v16 = 0;
  v13 = 0;
  v10 = strlen(a1);
  while ( v16 < v10 )                           // v10 = len
  {
    v2 = v13;                                   // v2= 0 
    v14 = v13 + 1;
    *(_BYTE *)(a2 + v2) = off_601238[(const unsigned __int8)a1[v16] >> 2];
    v11 = 16 * a1[v16] & 48;
    if ( v10 <= v16 + 1 )
    {
      v4 = v14;
      v5 = v14 + 1;
      *(_BYTE *)(a2 + v4) = off_601238[v11];
      *(_BYTE *)(v5 + a2) = 61;
      v6 = v5 + 1;
      v13 = v5 + 2;
      *(_BYTE *)(v6 + a2) = 61;
      break;
    }
    v3 = v14;
    v15 = v14 + 1;
    *(_BYTE *)(a2 + v3) = off_601238[((const unsigned __int8)a1[v16 + 1] >> 4) | v11];
    v12 = 4 * a1[v16 + 1] & 60;
    if ( v10 <= v16 + 2 )
    {
      *(_BYTE *)(a2 + v15) = off_601238[v12];
      v8 = v15 + 1;
      v13 = v15 + 2;
      *(_BYTE *)(v8 + a2) = 61;
      break;
    }
    *(_BYTE *)(a2 + v15) = off_601238[((const unsigned __int8)a1[v16 + 2] >> 6) | v12];
    v7 = v15 + 1;
    v13 = v15 + 2;
    *(_BYTE *)(a2 + v7) = off_601238[a1[v16 + 2] & 63];
    v16 += 3;
  }
  *(_BYTE *)(v13 + a2) = 0;
  return 0LL;
}